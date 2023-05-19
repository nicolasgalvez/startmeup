module.exports = {
  content: [
    "./**/*.php",
    "**/*.twig"
  ],
  theme: {
    extend: {
      maxWidth: {
        'container': '100rem', // 1600px
      },
      colors: {

      },
      spacing: {

      },
      inset: {

      },
      boxShadow: {
        'thick': '2px 2px 10px 3px rgba(0,0,0,0.4)'
      }
    },
    fontFamily: {
      'body': ['Noto Sans', 'Helvetica Neue', 'sans-serif']
    }
  },
  plugins: []
}
