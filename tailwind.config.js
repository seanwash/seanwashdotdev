module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        fontFamily: {
            sans: ['IBM Plex Sans', 'sans-serif'],
        },
        extend: {},
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
