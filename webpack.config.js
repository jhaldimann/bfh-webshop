const ExtractTextPlugin = require('extract-text-webpack-plugin');

module.exports = {
	entry: {
		'default': [
			'./styles/cart.scss',
			'./styles/footer.scss',
			'./styles/global.scss',
			'./styles/header.scss',
			'./styles/index.scss',
			'./styles/login.scss',
			'./styles/products.scss',
			'./styles/product.scss',
			'./styles/quantity-selection.scss',
			'./styles/register.scss',
			'./styles/sidebar.scss',
			'./styles/user.scss' ,
			'./styles/checkout.scss',
			'./styles/confirm.scss',
			'./styles/orders.scss'
		],
		'admin': ['./styles/admin.scss']
	},
	module: {
		rules: [
			{
				test: /\.scss$/,
				use: ExtractTextPlugin.extract({
					fallback: 'style-loader',
					use: ['css-loader', 'sass-loader']
				})
			}
		]
	},
	plugins: [
		new ExtractTextPlugin('[name].css')
	],
	stats: {
		warnings: false,
		version: true,
		chunks: false,
		children: false,
		env: true,
		timings: true,
	}
};
