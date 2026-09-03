import { defineConfig } from 'vite';

export default defineConfig({
	build: {
		outDir: 'dist',
		emptyOutDir: false,
		rollupOptions: {
			input: 'src/hgroup-control.tsx',
			output: {
				entryFileNames: 'hgroup-control.js',
				assetFileNames: '[name].[ext]',
				format: 'iife',
				name: 'TheatrumAdminHgroup',
				globals: {
					'@wordpress/element': 'wp.element',
					'@wordpress/hooks': 'wp.hooks',
					'@wordpress/block-editor': 'wp.blockEditor',
					'@wordpress/components': 'wp.components',
				},
			},
			external: [/^@wordpress\//],
		},
	},
});
