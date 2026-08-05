/**
 * List View Custom CSS Indicator
 *
 * Flags blocks that have "Additional CSS" set (core's built-in per-block
 * custom CSS support, stored at attributes.style.css) with a small "CSS"
 * badge next to their title in the editor List View.
 *
 * The List View block tree has no public filter hook — unlike
 * editor.BlockListBlock for the canvas, core renders it from a private
 * component tree with no addFilter extension point. Every row's link does
 * reliably carry `href="#block-<clientId>"` though, so this targets rows
 * with plain CSS attribute selectors injected via a <style> tag instead of
 * DOM injection, which keeps it immune to React re-render wipe-outs and
 * working regardless of whether the List View panel is open yet.
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

	// `::after` only attaches to the last selector in a comma-joined string, not
	// to each one — so build it into every selector individually, or every row
	// but the last ends up styling its real title element instead of a pseudo.
	const badgeSelectors = clientIds
		.map((clientId) => `a[href="#block-${clientId}"] .block-editor-list-view-block-select-button__label-wrapper::after`)
		.join(", ")

	// Same pill shape/family as core's own List View badges (e.g. the anchor
	// badge — components-badge), but using the site's admin theme color instead
	// of their gray, so a custom-CSS block reads as distinct from an anchored
	// one at a glance.
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
