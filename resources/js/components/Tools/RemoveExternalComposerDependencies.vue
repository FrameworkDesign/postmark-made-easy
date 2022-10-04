<template>
    <div>

        <button class="btn-primary mt-1 ml-0" @click="removeDependencies()">{{ __('Remove Dependencies') }}</button>

        <modal
            v-if="modalOpen"
            name="updater-composer-output"
            v-slot="{ close: closeModal }"
            :close-on-click="!composer.processing"
            :pivot-y="0.5"
            :overflow="false"
            width="75%"
            @opened="$events.$emit('start-composer')"
            @closed="modalOpen = false"
        >
            <div class="p-3 relative">
                <composer-output package="symfony/postmark-mailer" />
                <p>When this has finished running, please close and reload the page</p>
                <p v-if="composerHasFinished">Composer has finished</p>
                <button
                    class="btn-close absolute top-0 right-0 mt-2 mr-2"
                    :aria-label="__('Close')"
                    @click="closeModal"
                    v-html="'&times'"
                />
            </div>
        </modal>

    </div>
</template>

<script>
export default {

    data() {
        return {
            dependenciesInstalled: false,
            modalOpen: false,
            composerHasFinished: false
        };
    },

    computed: {
        toEleven() {
            return {timeout: Statamic.$config.get('ajaxTimeout')};
        },

        composer() {
            return this.$store.state.statamic.composer;
        },
    },

    created() {
        this.$events.$on('composer-finished', this.composerFinished);
    },

    methods: {
        removeDependencies() {
            if(confirm('are you sure?')) {
                this.$axios.post(cp_url(`weareframework/postmark-made-easy/remove-other-packages`), {}, this.toEleven);

                this.$toast.success("Removing 'symfony/postmark-mailer' 'symfony/http-client' packages")

                this.modalOpen = true
            }
        },

        composerFinished() {
            this.composerHasFinished = true
        },

        closeModal() {
            this.modalOpen = false
        }
    }
};
</script>
