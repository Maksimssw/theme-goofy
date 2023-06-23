module.exports = {
  publicPath: process.env.NODE_ENV === "production" ? "/routes/admin" : "/",
  outputDir: "../routes/admin/",
  indexPath: "index.php",
  productionSourceMap: false,
  devServer: {
    proxy: "http://0.0.0.0:3040",
  },
};
