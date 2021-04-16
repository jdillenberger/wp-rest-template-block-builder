const path = require('path')
const {
    VueLoaderPlugin
} = require('vue-loader')

let scripts = {
    'admin.js': './js/admin.js'
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
            'vue-wp-list-table': path.resolve(__dirname, 'node_modules', 'vue-wp-list-table', 'dist', 'vue-wp-list-table.browser.js', )
        }
    },
    module: {
        rules: [{
                test: /\.vue$/,
                loader: "vue-loader",
                exclude: "/node_modules/"
            },
            {
                test: /\.js$/,
                loader: "babel-loader",
                exclude: "/node_modules/"
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