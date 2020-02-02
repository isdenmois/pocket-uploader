import svelte from 'rollup-plugin-svelte';
import resolve from '@rollup/plugin-node-resolve';
import commonjs from '@rollup/plugin-commonjs';
import dev from 'rollup-plugin-dev';
import livereload from 'rollup-plugin-livereload';
import { terser } from 'rollup-plugin-terser';
import less from 'rollup-plugin-less';

const production = !process.env.ROLLUP_WATCH;

export default {
  input: 'src/main.js',
  output: {
    sourcemap: !production,
    format: 'iife',
    name: 'app',
    file: 'public/build/bundle.js',
  },
  plugins: [
    svelte({
      // enable run-time checks when not in production
      dev: !production,
      // we'll extract any component CSS out into
      // a separate file — better for performance
      css: css => {
        css.write('public/build/bundle.css');
      },
    }),

    // If you have external dependencies installed from
    // npm, you'll most likely need these plugins. In
    // some cases you'll need additional configuration —
    // consult the documentation for details:
    // https://github.com/rollup/plugins/tree/master/packages/commonjs
    resolve({
      browser: true,
      dedupe: ['svelte'],
    }),
    commonjs(),

    less({ output: 'public/build/global.css' }),
    !production &&
      dev({
        dirs: ['public'],
        proxy: {
          '/*.php': 'http://localhost/',
        },
      }),
    !production && livereload({ watch: 'public' }),

    production && terser(),
  ],
  watch: {
    clearScreen: false,
  },
};
