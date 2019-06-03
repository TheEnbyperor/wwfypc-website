const path = require("path");

module.exports = {
  entry: {
      devicerepair: path.resolve(__dirname, "site/wewillfixyouripad/js/src/devicerepair.js")
  },
  mode: "development",
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /(node_modules|bower_components)/,
        loader: "babel-loader",
        options: { presets: ["@babel/env"] }
      },
      {
        test: /\.css$/,
        use: ["style-loader", "css-loader"]
      }
    ]
  },
  resolve: { extensions: ["*", ".js", ".jsx"] },
  output: {
    path: path.resolve(__dirname, "site/wewillfixyouripad/js/"),
    filename: "[name].js"
  }
};