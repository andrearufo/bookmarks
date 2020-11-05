var app = new Vue({
    el: '#app',

    data: {
        ux: {
            fetch: false,
            error: false,
            loading: true,
            success: false
        },
        url: 'https://',
        bookmarks: []
    },

    methods: {
        getLinks: function(){
            this.ux.loading = true;

            this.$http.get('actions/getLinks.php').then(function(response){
                this.bookmarks = response.body;
                this.ux.loading = false;
            }, function(response){
                this.ux.error = true;
                this.ux.loading = false;
            });
        },

        saveLink: function(){
            this.ux.loading = true;

            this.$http.post('actions/saveLink.php', { url: this.url }, { emulateJSON: true }).then(function(response){
                this.ux.success = true;
                this.ux.loading = false;
                this.ux.fetch = false;
                this.getLinks();
            }, function(response){
                this.ux.error = true;
                this.ux.loading = false;
            });
        },

        fetchLink: function(){
            this.ux.loading = true;

            this.$http.post('actions/fetchLink.php', { url: this.url }, { emulateJSON: true }).then(function(response){
                this.ux.success = true;
                this.ux.fetch = true;
                this.ux.loading = false;
            }, function(response){
                this.ux.error = true;
                this.ux.loading = false;
            });
        }
    },

    mounted: function(){
        this.getLinks();
    }
});
