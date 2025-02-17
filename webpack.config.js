const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const rimraf = require('rimraf');

module.exports = {
    devtool: false,
    entry: {
        main: './resources/scripts/main.js',
        style: './resources/styles/style.scss',
    },
    output: {
        filename: 'scripts/[name].min.[fullhash].js',
        path: path.resolve(__dirname, 'public'),
    },
    module: {
        rules: [
            {
                test: /\.(sass|scss)$/,
                include: path.resolve(__dirname, 'resources/styles'),
                use: [
                    MiniCssExtractPlugin.loader,
                    {
                        loader: 'css-loader',
                        options: {
                            importLoaders: 2,
                            sourceMap: false,
                            url: false,
                        },
                    },
                    {
                        loader: 'postcss-loader',
                        options: {
                            sourceMap: false,
                            postcssOptions: {
                                path: 'postcss.config.js',
                            },
                        },
                    },
                    {
                        loader: 'sass-loader',
                        options: {
                            sourceMap: false,
                            sassOptions: {
                                outputStyle: 'compressed',
                            },
                        },
                    },
                ],
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'styles/[name].min.[fullhash].css',
        }),
        new CopyWebpackPlugin({
            patterns: [
                {
                    from: 'resources/fonts',
                    to: 'fonts',
                },
                {
                    from: 'resources/icons',
                    to: 'icons',
                },
                {
                    from: 'resources/images',
                    to: 'images',
                },
                {
                    from: 'resources/logos',
                    to: 'logos',
                },
            ],
            options: {
                concurrency: 100,
            },
        }),
        {
            apply: (compiler) => {
                compiler.hooks.beforeRun.tap(
                    'CleanPublicFolder',
                    (compilation) => {
                        rimraf.sync('./public');
                    },
                );
            },
        },
    ],
    optimization: {
        minimizer: [
            new CssMinimizerPlugin({
                minimizerOptions: {
                    preset: [
                        'default',
                        {
                            discardComments: {
                                removeAll: true,
                            },
                        },
                    ],
                },
            }),
        ],
    },
};
