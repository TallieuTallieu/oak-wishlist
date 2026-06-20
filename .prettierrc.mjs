/** @type {import("prettier").Config} */
const config = {
  plugins: ["@prettier/plugin-php"],
  trailingComma: "all",
  tabWidth: 4,
  semi: true,
  singleQuote: true,
  overrides: [
    {
      files: ["*.json", "*.yaml", "*.yml"],
      options: {
        tabWidth: 2,
      },
    },
  ],
};

export default config;
