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
        mainColorDarker: "#0b7087",
        appWhite: "#F1F5F9",
        appWhiteDarker: "#E2E8F0",
        appRed: "#8A3434",
        appRedDarker: "#722A2A"
      }
    },
  },
  plugins: [],
}

