import { defineConfig } from 'vite';

export default defineConfig({
	build: {
		outDir: 'dist',
		emptyOutDir: false,
		rollupOptions: {
			input: 'src/rich-excerpt.tsx',
			output: {
				entryFileNames: 'rich-excerpt.js',
				format: 'iife',
				name: 'TheatrumAdminRichExcerpt',
				globals: {
					'@wordpress/element': 'wp.element',
					'@wordpress/data': 'wp.data',
					'@wordpress/editor': 'wp.editor',
					'@wordpress/plugins': 'wp.plugins',
					'@wordpress/components': 'wp.components',
				},
			},
			external: (id) => /^@wordpress\//.test(id),
		},
	},
});
