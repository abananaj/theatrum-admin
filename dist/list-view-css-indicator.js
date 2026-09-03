(function(e){var t=`chance-list-view-css-indicator-styles`,n=null,r=!1;function i(){let t=(0,e.select)(`core/block-editor`);return t?.getClientIdsWithDescendants?t.getClientIdsWithDescendants().filter(e=>!!t.getBlockAttributes(e)?.style?.css?.trim()):[]}function a(){let e=document.getElementById(t);return e||(e=document.createElement(`style`),e.id=t,document.head.appendChild(e)),e}function o(){let e=i(),t=e.join(`,`);if(t===n)return;n=t;let r=a();if(!e.length){r.textContent=``;return}r.textContent=`
		${e.map(e=>`a[href="#block-${e}"] .block-editor-list-view-block-select-button__label-wrapper::after`).join(`, `)} {
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
	`}function s(){r||(r=!0,setTimeout(()=>{r=!1,o()},250))}(0,e.subscribe)(s,`core/block-editor`),s()})(wp.data);