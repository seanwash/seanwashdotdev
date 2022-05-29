module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontFamily: {
            sans: ['Nunito', 'sans-serif'],
        },
        extend: {},
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
