var app = new Vue({

    el: '#app',

    data: {
        ux: {
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

            this.$http.get('api/list').then(function(response){
                this.bookmarks = response.body.links;
                this.ux.loading = false;
            }, function(response){
                this.ux.error = true;
                this.ux.loading = false;
            });
        },

        saveLink: function(){
            this.ux.loading = true;

            this.$http.post('api/save', { url: this.url }, { emulateJSON: true }).then(function(response){
                this.ux.success = true;
                this.ux.loading = false;
                this.getLinks();
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
