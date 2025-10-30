import eslint from '@eslint/js'
import pluginVue from 'eslint-plugin-vue'
import tseslint from 'typescript-eslint'
import {
    defineConfigWithVueTs,
    vueTsConfigs,
} from '@vue/eslint-config-typescript'

export default defineConfigWithVueTs(
    {
        name: 'app/files-to-lint',
        files: ['**/*.{js,mjs,jsx,vue}'],
    },

    {
        name: 'app/files-to-ignore',
        ignores: ['**/dist/**', '**/dist-ssr/**', '**/coverage/**'],
    },
    eslint.configs.recommended,
    ...pluginVue.configs['flat/essential'],
    tseslint.configs.recommended,
    vueTsConfigs.recommended,
    {
        name: 'app/custom-rules',
        rules: {
            'vue/multi-word-component-names': 'off',
        },
    },
    {
        name: 'app/custom-rules',
        rules: {
            'vue/require-toggle-inside-transition': 'off',
        },
    }
);
