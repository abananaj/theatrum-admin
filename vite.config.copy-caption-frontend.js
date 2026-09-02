import { defineConfig } from "vite";

export default defineConfig({
  build: {
    outDir: "dist",
    emptyOutDir: false,
    rollupOptions: {
      input: "src/copy-caption-frontend.ts",
      output: {
        entryFileNames: "copy-caption-frontend.js",
        assetFileNames: "[name].[ext]",
        format: "iife",
        name: "TheatrumAdminCopyCaptionFrontend",
      },
    },
  },
});
