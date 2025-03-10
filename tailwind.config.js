/** @type {import('tailwindcss').Config} */
export default {
    content: ["./index.html", "./src/**/*.{js,ts,jsx,tsx}"],
    theme: {
        extend: {
            colors: {
                cp1: "#230E9A",
                cp2: "#7440B9",
                cp3: "#E37173",
                cp4: "#FFD2D2",
                cp5: "#F7DC2E",
            },
            fontFamily: {
              poppins: ["Poppins", "sans-serif"],
            }
        },
    },
    plugins: [],
};

