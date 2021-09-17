module.exports = {
  theme: {
    extend: {
      maxWidth: {
        'container': '90rem', // 1440px
        'site': '90rem'
      },
      colors: {
        'white': '#FFFFFF',
        'navy-blue': '#23345A',
        'red': '#E12A09',
        'cyan': '#40C8EA',
        'yellow': '#FFEB9A',
        'light-blue': '#C9EAF4',
        'lightest-blue': '#EBFAFF',
        'light-gray': '#ACACB4',
        'lightest-gray': '#F2F2F4',
        'dark-gray': '#64626F',
        'nav-gray': '#65718C',
        'bullet-gray': '#F1F1F2',
        'black': '#000000',
        'dark-red': '#951700'

      },
      spacing: {
        'tiny': '0.3rem',
        'quick-links': '26%',
        'pro-slid': '48%',
        '9': '2.5rem',
        '14': '3.5rem',
        '16': '4rem',
        '18': '4.5rem',
        '22': '5.626rem', // 90px
        '26': '6.25rem',
        '28': '7rem',
        '34': '8.5rem',
        '38': '9.25rem',
        '46': '11.75rem',
        '82': '20.75rem',
        'x-large': '27.5rem'
      },
      inset: {

      },
      boxShadow: {
        'thick': '2px 2px 10px 3px rgba(0,0,0,0.4)'
      }
    },
    screens: {
      'sm': '640px',
      'md': '768px',
      'lg': '1024px',
      'xl': '1280px',
      '1xl': '1340px',
      '2xl': '1536px',
    },
    fontFamily: {
      'body': ['Raleway', 'sans-serif']
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
      '26': '1.625rem', // 26px
      '28': '1.75rem', // 28px
      '32': '2rem', // 32px
      '34': '2.125rem', // 34px
      '36': '2.25rem', // 36px
      '38': '2.375rem', // 38px
      '40': '2.5rem', // 40px
      '50': '3.125rem', // 50px
      '52': '3.25rem', // 52px
      '64': '4rem', // 64px
      '66': '4.125rem', // 66px
      '70': '4.375rem', // 70px
      '80': '5rem', // 80px
      '100': '6.25rem' // 100px
    },
  },
  variants: {
    visibility: ['responsive', 'hover', 'group-hover'],
    backgroundColor: ['responsive', 'hover', 'group-hover']
  },
  plugins: []
}
