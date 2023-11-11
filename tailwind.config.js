/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      keyframes: {
        toast : {
          '0%, 100%' : {opacity:0, transform: 'translateY(-2rem)'},
          '25%, 75%' : {opacity:1, transform: 'translateY(0rem)'},
        }
      },
      animation: {
        toast: 'toast 3.5s ease-in-out forwards'
      },
      colors: {
        primary: {
          '50': '#fcf4f4',
          '100': '#fae6e6',
          '200': '#f7d1d1',
          '300': '#f0b1b1',
          '400': '#e58484',
          '500': '#d75c5c',
          '600': '#c33f3f',
          '700': '#a33232',
          '800': '#8c2e2e', //default
          '900': '#712b2b',
          '950': '#3d1212',
      },
      
      }
    },
  },
  plugins: [],
}