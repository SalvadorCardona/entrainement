/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ['./module/**/*.{html,js,vue}'],
    plugins: [
        require('@tailwindcss/typography'),
        require('@tailwindcss/forms'),
        require('@tailwindcss/aspect-ratio'),
        require('@tailwindcss/container-queries'),
    ]
}
