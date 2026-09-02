/**
 * List View Custom CSS Indicator — flags blocks with "Additional CSS" set (attributes.style.css) with a "CSS" badge next to their title in the editor List View.
 * The List View block tree has no public filter hook (unlike editor.BlockListBlock), but every row reliably carries `href="#block-<clientId>"`, so this targets rows with CSS attribute selectors injected via a <style> tag rather than DOM injection — immune to React re-render wipe-outs and works whether or not the List View panel is open yet.
 */
import { select, subscribe } from "@wordpress/data"

const STYLE_TAG_ID = "chance-list-view-css-indicator-styles"
const DEBOUNCE_MS = 250

let lastSignature: string | null = null
let scheduled = false

function getClientIdsWithCustomCSS(): string[] {
	// @ts-ignore
	const editorStore = select("core/block-editor")

	if (!editorStore?.getClientIdsWithDescendants) {
		return []
	}

	return editorStore.getClientIdsWithDescendants().filter((clientId: string) => {
		const attributes = editorStore.getBlockAttributes(clientId)
		return !!attributes?.style?.css?.trim()
	})
}

function getStyleTag(): HTMLStyleElement {
	let styleTag = document.getElementById(STYLE_TAG_ID) as HTMLStyleElement | null

	if (!styleTag) {
		styleTag = document.createElement("style")
		styleTag.id = STYLE_TAG_ID
		document.head.appendChild(styleTag)
	}

	return styleTag
}

function updateIndicators(): void {
	const clientIds = getClientIdsWithCustomCSS()
	const signature = clientIds.join(",")

	if (signature === lastSignature) {
		return
	}
	lastSignature = signature

	const styleTag = getStyleTag()

	if (!clientIds.length) {
		styleTag.textContent = ""
		return
	}

	// `::after` only attaches to the last selector in a comma-joined string — build it into every selector individually, or every row but the last styles its real title element instead of a pseudo.
	const badgeSelectors = clientIds
		.map((clientId) => `a[href="#block-${clientId}"] .block-editor-list-view-block-select-button__label-wrapper::after`)
		.join(", ")

	// Same pill shape/family as core's List View badges (e.g. the anchor badge), but the admin theme color instead of gray, so a custom-CSS block reads as distinct at a glance.
	styleTag.textContent = `
		${badgeSelectors} {
			content: "CSS";
			display: inline-flex;
			align-items: center;
			flex-shrink: 0;
			box-sizing: border-box;
			height: 18px;
			padding: 2px 8px;
			border-radius: 2px;
			background-color: var(--wp-admin-theme-color, #3858e9);
			color: #fff;
			font-size: 12px;
			font-weight: 400;
			line-height: 1;
			white-space: nowrap;
			pointer-events: none;
		}
	`
}

function scheduleUpdate(): void {
	if (scheduled) {
		return
	}
	scheduled = true
	setTimeout(() => {
		scheduled = false
		updateIndicators()
	}, DEBOUNCE_MS)
}

subscribe(scheduleUpdate, "core/block-editor")
scheduleUpdate()
