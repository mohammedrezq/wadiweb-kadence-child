const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");
const { CleanWebpackPlugin } = require("clean-webpack-plugin");
const UglifyJsPlugin = require("uglifyjs-webpack-plugin");
const WebpackRTLPlugin = require("webpack-rtl-plugin");

/**
 * Paths
 */

const assetsFolder = "assets";
const adminAssetsFolder = `${assetsFolder}/admin`;

const mainAssets = path.resolve(__dirname, `${assetsFolder}`);
const entry = {

  "wadi-basic": [__dirname + `/${assetsFolder}/src/basic.js`],
//   "wadi-accordion": [__dirname + `/${assetsFolder}/src/accordion.js`],
//   "wadi-admin-widgets": [__dirname + `/${adminAssetsFolder}/admin-widgets.js`],
};
const mainDistribution = path.resolve(__dirname, `${assetsFolder}/dist`);
const mainMinified = path.resolve(__dirname, `${assetsFolder}/min`);

const output = {
  filename: "[name].min.js",
  path: mainMinified,
};

const outputDev = {
  filename: "[name].js",
  path: mainDistribution,
};

const rules = [
  {
    test: /\.(png|jpe?g|gif|ico)$/i,
    exclude: /node_modules/,
    use: [
      {
        loader: "file-loader",
      },
    ],
  },
  {
    test: /\.(woff2?|ttf|otf|eot|svg)$/,
    exclude: /node_modules/,
    loader: "file-loader",
    options: {
      name: "[path][name].[ext]",
    },
  },
  {
    test: /\.scss$/,
    exclude: /node_modules/,
    use: [
      MiniCssExtractPlugin.loader,
      "css-loader",
      "resolve-url-loader",
      {
        loader: "postcss-loader",
      },
      "sass-loader",
    ],
  },
  {
    test: /\.js$/,
    exclude: /node_modules/,
    use: {
      loader: "babel-loader",
      options: {
        presets: [["@babel/preset-env", { targets: "defaults" }]],
      },
    },
  },
];

const minimizing = [
  new CssMinimizerPlugin({
    parallel: true,
    minimizerOptions: {
      preset: [
        "default",
        {
          discardComments: { removeAll: true },
        },
      ],
    },
  }),

  new UglifyJsPlugin({
    extractComments: true,
    cache: false,
    parallel: true,
    sourceMap: false,
  }),
];

/**
 * Note: argv.mode will return 'development' or 'production'.
 *
 * @param argv
 */
const plugins = (argv) => [
  new CleanWebpackPlugin({
    cleanStaleWebpackAssets: "production" === argv.mode, // Automatically remove all unused webpack assets on rebuild, when set to true in production. ( https://www.npmjs.com/package/clean-webpack-plugin#options-and-defaults-optional )
  }),

  new MiniCssExtractPlugin(),
  new WebpackRTLPlugin(),
];

/**
 * Module Exports
 *
 * @param env
 * @param argv
 */
module.exports = (env, argv) => ({
  mode: "development",
  context: mainAssets,
  entry,
  output: "production" === argv.mode ? output : outputDev,
  devtool: "source-map",
  optimization: {
    minimize: "production" === argv.mode ? true : false,
    minimizer: minimizing,
  },
  plugins: plugins(argv),
  module: {
    rules,
  },
});
