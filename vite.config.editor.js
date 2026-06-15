import { defineConfig } from "vite";

export default defineConfig({
  build: {
    outDir: "dist",
    emptyOutDir: false,
    rollupOptions: {
      input: "src/sr-only-blocks.tsx",
      output: {
        entryFileNames: "sr-only-blocks.js",
        assetFileNames: "[name].[ext]",
        format: "iife",
        name: "TheatrumAdminEditor",
        globals: {
          "@wordpress/element": "wp.element",
          "@wordpress/hooks": "wp.hooks",
          "@wordpress/block-editor": "wp.blockEditor",
          "@wordpress/components": "wp.components",
          "@wordpress/blocks": "wp.blocks",
          "@wordpress/data": "wp.data",
        },
      },
      external: [/^@wordpress\//],
    },
  },
});
