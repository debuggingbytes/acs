/** @type {import('tailwindcss').Config} */
const tailwindSafelist = [
    'font-bold',
    'italic',
    'underline',
    'line-through',
    'text-red-500',
    'text-lg',
    'text-xl',
    'text-2xl',
    'text-3xl',
    'text-4xl',
    'text-5xl',
    'text-6xl',
    'text-center',
    'text-left',
    'text-right',
    'blockquote',
    'text-sm',
    'text-base',
    'text-blue-500',
    'hover:text-blue-700',
    'hover:underline',
    'list-disc',
    'list-decimal',
    'list-lower-alpha',
    'list-inside',
    'list-outside',
    'ml-4',
    'mr-4',
    'code',
    'bg-gray-200',
    'bg-gray-300',
    'p-2',
    'py-4',
    'px-6',
    'm-2',
    'my-4',
    'mx-6',
    'border',
    'rounded',
    'shadow-lg',
    'text-red-500',
    'text-blue-500',
    'text-green-500',
    'text-yellow-500',
    'pl-2',
    'border-l-4',
    'border-cyan-700',
    'w-5/6',

];
module.exports = {
    purge: {
        content: [
            "./resources/**/*.blade.php",
            "./resources/**/*.js",
            "./resources/**/*.vue",
        ],
        options: {
            safelist: tailwindSafelist,
        },
    },
    theme: {
        extend: {},
    },
    plugins: [],
};
