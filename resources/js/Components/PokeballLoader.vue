<template>
    <transition
        mode="out-in"
        enter-active-class="transition duration-300 ease-out"
        leave-active-class="transition duration-200 ease-in"
        enter-class="opacity-0"
        leave-class="opacity-100"
        enter-to-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="loading"
            className="loader"
            role="progressbar"
            aria-label="loading pokethings"
        >
            <div className="pokeball-container">
                <div className="pokeball"></div>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: {
            loading: {
                type: Boolean,
            },
        },
    };
</script>

<style lang="scss" scoped>
    @keyframes bounce {
        10% {
            transform: translateY(-35px);
        }
        15% {
            transform: translateY(0px);
        }
        25% {
            transform: translateY(-15px);
        }
        30% {
            transform: translateY(0px);
        }
        50% {
            transform: rotateZ(10deg);
        }
        60% {
            transform: rotateZ(-10deg);
        }
        70% {
            transform: rotateZ(10deg);
        }
        100% {
            transform: rotateZ(0deg);
        }
    }

    @keyframes shadow {
        10% {
            transform: scaleX(0.6);
        }
        15% {
            transform: scaleX(1);
        }
        25% {
            transform: scaleX(0.8);
        }
        30% {
            transform: scaleX(1);
        }
        50% {
            transform: translateX(5px);
        }
        60% {
            transform: translateX(-5px);
        }
        70% {
            transform: translateX(5px);
        }
        100% {
            transform: translateX(0px);
        }
    }

    .loader {
        align-items: center;
        display: flex;
        height: 100%;
        justify-content: center;
        width: 100%;

        .pokeball-container {
            height: 75px;
            position: relative;
            width: 75px;

            .pokeball {
                animation-duration: 1.5s;
                animation-iteration-count: infinite;
                animation-name: bounce;
                animation-timing-function: ease-in-out;
                height: 100%;
                position: relative;
                transform-origin: bottom center;
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;

                &::after {
                    border-color: black;
                    border-radius: 50%;
                    border-style: solid;
                    border-width: 2px;
                    background: linear-gradient(
                        0deg,
                        rgba(255, 255, 255, 1) 0%,
                        rgba(255, 254, 254, 1) 49.5%,
                        rgba(0, 0, 0, 1) 49.5%,
                        rgba(0, 0, 0, 1) 51.5%,
                        rgba(244, 0, 31, 1) 51.5%,
                        rgba(255, 0, 0, 1) 100%
                    );
                    content: "";
                    height: 100%;
                    position: absolute;
                    width: 100%;
                }

                &::before {
                    border-radius: 50%;
                    border: 2px solid black;
                    background: radial-gradient(
                        circle,
                        rgba(255, 255, 255, 1) 0%,
                        rgba(255, 255, 255, 1) 40%,
                        rgba(0, 0, 0, 1) 40%,
                        rgba(0, 0, 0, 1) 60%,
                        rgba(255, 255, 255, 1) 60%,
                        rgba(255, 255, 255, 1) 100%
                    );
                    content: "";
                    height: 15px;
                    left: 50%;
                    position: absolute;
                    top: 50%;
                    transform: translate(-50%, -50%);
                    width: 15px;
                    z-index: 1;
                }
            }
        }
    }
</style>
