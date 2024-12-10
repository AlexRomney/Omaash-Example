<template>
    <button
        :disabled="disabled"
        :type="type"
        :class="[
            buttonClass,
            sizeClass,
            widthClass,
            disabledClass,
            noClickClass,
        ]"
        class="inline-block text-base text-center uppercase bg-white border-current border-solid outline-none focus:outline-none whitespace-nowrap"
    >
        <slot />
    </button>
</template>

<script>
    export default {
        props: {
            disabled: {
                type: Boolean,
                default: false,
            },
            noClick: {
                type: Boolean,
                default: false,
            },
            type: {
                type: String,
                default: "submit",
            },
            color: {
                type: String,
                default: "lightBlue",
                required: false,
                validator(value) {
                    return [
                        "lightBlue",
                        "darkBlue",
                        "darkGray",
                        "medGray",
                        "lightGray",
                        "youtube",
                        "instagram",
                        "tiktok",
                        "twitter",
                        "shirts",
                        "patreon",
                        "venmo",
                        "paypal",
                        "cashapp",
                    ].includes(value);
                },
            },
            size: {
                type: String,
                default: "regular",
                required: false,
                validator(value) {
                    return ["auto", "small", "regular"].includes(value);
                },
            },
            width: {
                type: String,
                default: "regular",
                required: false,
                validator(value) {
                    return ["auto", "small", "regular", "full"].includes(value);
                },
            },
        },
        data() {
            return {
                buttonClass: {
                    "text-lightBlue": this.color === "lightBlue",
                    "text-darkBlue": this.color === "darkBlue",
                    "text-darkGray": this.color === "darkGray",
                    "text-medGray": this.color === "medGray",
                    "text-lightGray": this.color === "lightGray",
                    "text-youtube": this.color === "youtube",
                    "text-instagram": this.color === "instagram",
                    "text-tiktok": this.color === "tiktok",
                    "text-twitter": this.color === "twitter",
                    "text-shirts": this.color === "shirts",
                    "text-patreon": this.color === "patreon",
                    "text-venmo": this.color === "venmo",
                    "text-paypal": this.color === "paypal",
                    "text-cashapp": this.color === "cashapp",
                },
                sizeClass: {
                    auto: this.size === "auto",
                    small: this.size === "small",
                    regular: this.size === "regular",
                },
                widthClass: {
                    "w-auto": this.width === "auto",
                    "w-full": this.width === "full",
                    "w-small": this.width === "small",
                    "w-regular": this.width === "regular",
                },
                disabledClass: {
                    "cursor-not-allowed opacity-50": this.disabled,
                },
                noClickClass: {
                    "cursor-default": this.noClick,
                    "cursor-pointer": !this.noClick,
                },
            };
        },
    };
</script>
<style scoped>
    button {
        border-width: 5px;
        border-color: currentColor;
        transition: all 0.25s ease;
        height: fit-content;
    }

    .auto {
        padding: 4px;
        box-shadow: 0px 0px, 1px 1px, 2px 2px, 3px 3px, 4px 4px, 5px 5px,
            6px 6px;
        margin-bottom: 6px;
    }

    .small {
        padding: 4px 16px;
        box-shadow: 0px 0px, 1px 1px, 2px 2px, 3px 3px, 4px 4px, 5px 5px,
            6px 6px;
        margin-bottom: 6px;
    }
    .regular {
        padding: 8px 16px;
        box-shadow: 0px 0px, 1px 1px, 2px 2px, 3px 3px, 4px 4px, 5px 5px,
            6px 6px, 7px 7px, 8px 8px, 9px 9px, 10px 10px, 11px 11px, 12px 12px;
        margin-bottom: 12px;
    }

    .w-auto {
        width: auto;
    }
    .w-small {
        min-width: 132px;
    }
    .w-regular {
        min-width: 164px;
    }
</style>
