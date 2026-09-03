// Vite inlines CSS into IIFE bundles (see vite.config.editor.js), so sr-only-blocks.tsx never emitted the stylesheet theatrum-admin.php enqueues on the frontend — this CSS-only entry writes dist/sr-only-blocks.css.
import { defineConfig } from 'vite';

export default defineConfig({
	build: {
		outDir: 'dist',
		emptyOutDir: false,
		rollupOptions: {
			input: 'src/scss/sr-only.scss',
			output: { assetFileNames: 'sr-only-blocks.[ext]' },
		},
	},
});
