const { defineConfig } = require("@vue/cli-service");
module.exports = defineConfig({
  transpileDependencies: true,
  devServer: {
    proxy: {
      "^/api": {
        target: "https://david.dnick.ddcode.co",
        changeOrigin: true,
      },
    },
  },
});
