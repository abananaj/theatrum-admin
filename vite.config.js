import { defineConfig } from "vite";

export default defineConfig({
  build: {
    outDir: "dist",
    emptyOutDir: true,
    rollupOptions: {
      input: {
        "block-custom-css": "src/block-custom-css.ts",
        "block-row-customization": "src/block-row-customization.ts",
        "sr-only-blocks": "src/sr-only-blocks.tsx",
      },
      output: {
        entryFileNames: "[name].js",
        assetFileNames: "[name].[ext]",
      },
      external: [
        // WordPress packages are loaded via wp_enqueue_script dependencies
        /^@wordpress\//,
      ],
    },
  },
});
