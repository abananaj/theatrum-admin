import { defineConfig } from "vite";

export default defineConfig({
  build: {
    outDir: "dist",
    emptyOutDir: false,
    rollupOptions: {
      input: "src/list-view-css-indicator.ts",
      output: {
        entryFileNames: "list-view-css-indicator.js",
        assetFileNames: "[name].[ext]",
        format: "iife",
        name: "TheatrumAdminListViewCssIndicator",
        globals: {
          "@wordpress/data": "wp.data",
        },
      },
      external: [/^@wordpress\//],
    },
  },
});
