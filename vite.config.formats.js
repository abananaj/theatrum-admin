import { defineConfig } from "vite";

export default defineConfig({
  build: {
    outDir: "dist",
    emptyOutDir: false,
    rollupOptions: {
      input: "src/custom-formats.tsx",
      output: {
        entryFileNames: "custom-formats.js",
        assetFileNames: "[name].[ext]",
        format: "iife",
        name: "TheatrumAdminFormats",
        globals: {
          "@wordpress/element": "wp.element",
          "@wordpress/block-editor": "wp.blockEditor",
          "@wordpress/rich-text": "wp.richText",
          "@wordpress/primitives": "wp.primitives",
        },
      },
      external: (id) => /^@wordpress\//.test(id) && id !== "@wordpress/icons",
    },
  },
});
