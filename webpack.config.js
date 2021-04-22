const path = require('path')
const {
    VueLoaderPlugin
} = require('vue-loader')

let scripts = {
    'admin.js': './js/admin.vue.jsx',
    'blocks-backend.js': './js/blocks-backend.jsx',
    'blocks-frontend.js': './js/blocks-frontend.vue.jsx',
}

module.exports = {
    context: __dirname,
    entry: scripts,
    output: {
        path: path.resolve(__dirname, 'jsdist'),
        filename: function(module) {
            return module.chunk.name
        }
    },
    resolve: {
        alias: {
            vuejs: path.resolve(__dirname, 'node_modules', 'vue', 'dist', 'vue.esm.js'),
            'vue-wp-list-table': path.resolve(__dirname, 'node_modules', 'vue-wp-list-table', 'dist', 'vue-wp-list-table.browser.js', ),
            'vue-json-tree-viewer': path.resolve(__dirname, 'node_modules', 'vue-json-tree-viewer', 'dist', 'index.js', )
        }
    },
    module: {
        rules: [{
                test: /\.vue$/,
                loader: "vue-loader",
                exclude: "/node_modules/"
            },
            {
                test: /\.vue\.jsx?$/,
                loader: "babel-loader",
                exclude: ["/node_modules/"],
                options: {
                    presets: [
                        "@babel/preset-env",
                        "@babel/preset-react",
                        "@vue/babel-preset-jsx"
                    ]
                }
            },
            {
                test: /^[^\.]*\.jsx$/,
                loader: "babel-loader",
                exclude: ["/node_modules/"],
                options: {
                    presets: [
                        "@babel/preset-env",
                        "@babel/preset-react"
                    ]
                }
            },
            {
                test: /\.css$/,
                use: [
                    'vue-style-loader',
                    'css-loader'
                ]
            }
        ]

    },
    plugins: [
        new VueLoaderPlugin(),
    ]

}