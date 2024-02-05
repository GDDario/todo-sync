/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      colors: {
        mainColor: "#0C88A4",
        appWhite: "#F1F5F9",
        appWhiteDarker: "#E2E8F0"
      }
    },
  },
  plugins: [],
}

