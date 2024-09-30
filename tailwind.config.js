/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php", // Scan all PHP files in the project
    "./*.{html,js,php}", // You can add more paths as needed
    "./components/*.{html,js,php}",
    "./**/*.php", // Adjust paths as needed
    "./components/**/*.php",
    "./**/*.html",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
