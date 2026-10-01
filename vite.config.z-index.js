import { defineConfig } from 'vite';

export default defineConfig({
	build: {
		outDir: 'dist',
		emptyOutDir: false,
		rollupOptions: {
			input: 'src/z-index-controls.tsx',
			output: {
				entryFileNames: 'z-index-controls.js',
				assetFileNames: '[name].[ext]',
				format: 'iife',
				name: 'TheatrumAdminZIndex',
				globals: {
					'@wordpress/element': 'wp.element',
					'@wordpress/hooks': 'wp.hooks',
					'@wordpress/block-editor': 'wp.blockEditor',
					'@wordpress/components': 'wp.components',
					'@wordpress/blocks': 'wp.blocks',
					'@wordpress/data': 'wp.data',
				},
			},
			external: [/^@wordpress\//],
		},
	},
});
