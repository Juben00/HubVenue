/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./src/**/*.{php,html,js}", // Scan all PHP, HTML, and JS files in the project      // Scan all HTML files in the project
    "./**/*.php",    // Scan all PHP files in the project
    "./src/**/*.{html,js,php}", // You can add more paths as needed
    "./src/components/*.{html,js,php}",
    './src/**/*.php',     // Adjust paths as needed
    './components/**/*.php',
    './**/*.html',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
