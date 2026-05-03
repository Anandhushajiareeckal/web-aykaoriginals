/** @type {import('tailwindcss').Config} */
export default {
  content: ["./resources/**/*.blade.php","./resources/**/*.js"],
  theme: {
    extend: {
      colors: {
        navy:      { DEFAULT: '#0B132B', light: '#1C2951' },
        slate:     { DEFAULT: '#5E6472', light: '#8B90A0' },
        border:    '#E2E4EA',
        'off-white': '#F8F8FA',
      },
      fontFamily: {
        sans:    ['Montserrat', 'sans-serif'],
        display: ['"Cormorant Garamond"', 'serif'],
      },
    },
  },
  plugins: [require('@tailwindcss/typography'), require('@tailwindcss/forms')],
}
