/**
 * Caption Copy-On-Click — frontend behavior
 *
 * Delegated on document so it works for captions added dynamically (e.g.
 * sliders, AJAX-loaded content). Styling (hover hint + "Copied!" bubble)
 * lives in scss/copy-caption.scss, bundled into this same entry.
 */
import "./scss/copy-caption.scss"

const HIDE_DELAY_MS = 2000

function getTooltip(): HTMLDivElement {
	let tooltip = document.querySelector<HTMLDivElement>(".chance-caption-copied-tooltip")

	if (!tooltip) {
		tooltip = document.createElement("div")
		tooltip.className = "chance-caption-copied-tooltip"
		document.body.appendChild(tooltip)
	}

	return tooltip
}

function showCopiedTooltip(x: number, y: number): void {
	const tooltip = getTooltip()

	tooltip.textContent = "Copied!"
	tooltip.style.left = `${x}px`
	tooltip.style.top = `${y - 8}px`

	window.clearTimeout((tooltip as any)._hideTimeout)
	// Force a reflow so re-triggering the transition (rapid clicks) still fades in.
	tooltip.classList.remove("is-visible")
	void tooltip.offsetWidth
	tooltip.classList.add("is-visible")

	;(tooltip as any)._hideTimeout = window.setTimeout(() => {
		tooltip.classList.remove("is-visible")
	}, HIDE_DELAY_MS)
}

document.addEventListener("click", (e: MouseEvent) => {
	const caption = (e.target as HTMLElement)?.closest<HTMLElement>("figcaption.has-caption-copy")
	if (!caption || !navigator.clipboard) {
		return
	}

	navigator.clipboard.writeText(caption.textContent?.trim() ?? "").then(() => {
		showCopiedTooltip(e.clientX, e.clientY)
	})
})
