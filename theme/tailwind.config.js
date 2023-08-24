module.exports = {
  content: [
    "./**/*.php",
    "**/*.twig",
    "**/*.vue"
  ],
  plugins: {
    tailwindcss: {},
    autoprefixer: {},
  },
  theme: {
    extend: {
      maxWidth: {
        'container': '112.5rem', // 1800px
        'interior': '99.75rem', //1596px
        'reading':'57rem', // 912px
        '1440': '90rem',
      },
      maxHeight: {
        '450': '450px',
        '440': '440px',
        '12' : '3rem',
      },
      minHeight: {
        '12' : '3rem',
      },
      colors: {
        'dark-gray': '#554F4A',
        'light-gray': '#E8E5E2',
        'lightest-gray' : '#EDEDED',
      },
      spacing: {
        '114': '7.124rem',
        '440': '27.5rem',
      },
      borderRadius: {

        'large': '1.5rem',
      },
      fontSize: {
        'xs': '0.75rem', // 12px
        'sm': '0.875rem', // 14px
        'base': '1rem', // 16px
        'lg': '1.125rem', // 18px
        'xl': '1.1875rem', // 19px
        '20': '1.25rem', // 20px
        '22': '1.375rem', // 22px
        '24': '1.5rem', // 24px
        '25': '1.563rem', // 25
        '26': '1.625rem', // 26px
        '28': '1.75rem', // 28px
        '30': '1.875rem', //30px
        '32': '2rem', // 32px
        '34': '2.125rem', // 34px
        '36': '2.25rem', // 36px
        '38': '2.375rem', // 38px
        '40': '2.5rem', // 40px
        '45': '2.813rem', //45px
        '50': '3.125rem', // 50px
        '52': '3.25rem', // 52px
        '60': '3.75rem', // 60px
        '64': '4rem', // 64px
        '66': '4.125rem', // 66px
        '70': '4.375rem', // 70px
        '80': '5rem', // 80px
        '90': '5.625rem', //90px
        '100': '6.25rem' // 100px
      },
      inset: {

      },
      boxShadow: {
        'thick': '2px 2px 10px 3px rgba(0,0,0,0.4)'
      }
    },
  },
  plugins: []
}
