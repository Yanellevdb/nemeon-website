const path = require('path')
const webpack = require('webpack')

// include the js minification plugin
const UglifyJSPlugin = require('uglifyjs-webpack-plugin')

// include the css extraction and minification plugins
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin')
const FixStyleOnlyEntriesPlugin = require('webpack-fix-style-only-entries')

const recursiveIssuer = (m, c) => {
  const issuer = m.issuer

  if (issuer) {
    return recursiveIssuer(issuer, c)
  }

  const chunks = m._chunks

  for (const chunk of chunks) {
    return chunk.name
  }

  return false
}
const scssFiles = [
  {
    name: 'style',
    path: './assets/scss/*.scss',
  },
]

const entryPoints = {
  // default entry point (main JS file)
  radikal: './assets/js/radikal.js',
  style: './assets/scss/style.scss',
  'editor-style': './assets/scss/editor-style.scss',
}

// scssFiles.map(scssFile => entryPoints[scssFile.name] = scssFile.path)

// set up empty cache groups object
const cacheGroups = {}

// add scssFiles to cache groups
scssFiles.map(
  (scssFile) =>
    (cacheGroups[scssFile.name] = {
      name: scssFile.name,
      test: (m, c, entry = scssFile.name) =>
        m.constructor.name === 'CssModule' && recursiveIssuer(m) === entry,
      chunks: 'all',
      enforce: true,
    })
)

module.exports = {
  entry: entryPoints,
  //entry: '/assets/js/radikal.js',
  /*devServer: {
    static: {
      directory: path.join(__dirname, 'public'),
    },
    host: 'localhost',
    port: 80,
  },*/
  devServer: {
    open: true,
    host: 'localhost',
    port: 80,
  },
  output: {
    path: path.resolve(__dirname),
    filename:
      process.env.NODE_ENV === 'production'
        ? './../website/web/app/themes/timber/static/assets/js/[name].min.js'
        : './../website/web/app/themes/timber/static/assets/js/[name].min.js',
  },
  mode: 'development',
  devtool: false, // passes sourcemap control to SourceMapDevToolPlugins
  module: {
    rules: [
      // perform js babelization on all .js files
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: {
          loader: 'babel-loader',
        },
      },
      // compile all .scss files to plain old css
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          {
            loader: MiniCssExtractPlugin.loader,
          },
          {
            loader: 'css-loader',
            options: {
              sourceMap: true,
              url: false,
            },
          },
          {
            loader: 'sass-loader',
            options: {
              sourceMap: true,
            },
          },
        ],
      },
      {
        test: /\.svg/,
        use: {
          loader: 'svg-url-loader',
          options: {
            // make all svg images to work in IE
            iesafe: true,
          },
        },
      },
      {
        test: /.scss/,
        enforce: 'pre',
        loader: 'import-glob-loader',
      },
    ],
  },
  plugins: [
    // extract css into dedicated file
    // editor-style needs to be directly in theme directory
    new MiniCssExtractPlugin({
      filename: ({ chunk: { name } }) => {
        let location =
          process.env.NODE_ENV === 'production'
            ? './../website/web/app/themes/timber/static/assets/css/[name].min.css'
            : './../website/web/app/themes/timber/static/assets/css/[name].min.css'

        if (name === 'editor-style') {
          location =
            process.env.NODE_ENV === 'production'
              ? './../website/web/app/themes/timber/[name].css'
              : './../website/web/app/themes/timber/[name].css'
        }

        return location
      },
    }),
    new webpack.SourceMapDevToolPlugin({
      filename:
        './../website/web/app/themes/timber/static/assets/maps/[name].map',
    }),
    new FixStyleOnlyEntriesPlugin(),
  ],
  optimization: {
    splitChunks: {
      cacheGroups: cacheGroups,
    },
    minimizer: [
      // enable the js minification pluginnpm run
      new UglifyJSPlugin({
        cache: true,
        parallel: true,
      }),
      // enable the css minification plugin
      new OptimizeCSSAssetsPlugin({}),
    ],
  },
}
