import { defineConfig } from "vite";

export default defineConfig({
  build: {
    outDir: "dist",
    emptyOutDir: true,
    rollupOptions: {
      input: {
        "index": "src/index.ts",
      },
      output: {
        entryFileNames: "[name].js",
        assetFileNames: "[name].[ext]",
        format: "iife",
        name: "TheatrumAdmin",
      },
    },
  },
});
