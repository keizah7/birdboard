module.exports = {
    theme: {
        backgroundColor: theme => ({
            page: 'var(--page-background-color)',
            card: 'var(--card-background-color)',
            button: 'var(--button-background-color)',
            header: 'var(--header-background-color)'
        }),
        colors: {
            error: 'var(--text-error-color)',
            grey: {
                default: 'rgba(0, 0, 0, 0.4)',
                lighter: '#F5F6F9',
            },
            white: {
                default: '#fff',
            },
            blue: {
                default: '#47cdff',
                light: '#8ae2fe',
            },
            default: 'var(--text-default-color)',
            accent: {
                default: 'var(--text-accent-color)',
                light: 'var(--text-accent-light-color)',
            },
            muted: {
                default: 'var(--text-muted-color)',
                light: 'var(--text-muted-light-color)'
            }
        },
        boxShadow: {
            default: '0 0 5px 0 rgba(0, 0, 0, 0.08)',
            blue: '0 2px 7px 0 #b0eaff',
        },
        extend: {},
    },
    variants: {},
    plugins: [],
}
