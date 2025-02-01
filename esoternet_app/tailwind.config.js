module.exports = {
  content: [
    './templates/**/*.html.twig',
  ],
  theme: {
    extend: {},
  },
  plugins: [require('daisyui')],
  daisyui: {
    themes: ["light", "synthwave"],
  },
};
