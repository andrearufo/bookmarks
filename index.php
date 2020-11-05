<!doctype html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Bookmarks</title>

    <link rel="stylesheet" href="dist/styles/main.css">

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

</head>
<body>

    <div id="app">
        <div class="container">

            <div v-if="ux.loading">

                Loading...

            </div>
            <div class="content" v-else>

                <form class="card card-body my-5" method="post" enctype="multipart/form-data" @submit.prevent="saveLink">
                    <div class="row">
                        <div class="col-lg-9">

                            <input type="url" class="form-control" v-model="url">

                        </div>
                        <div class="col-lg-3">

                            <!-- <button type="button" class="btn btn-secondary">Fetch</button> -->
                            <button type="submit" class="btn btn-block btn-primary">Save</button>

                        </div>
                    </div>
                </form>

                <div v-if="bookmarks.length == 0" class="alert alert-warning">No bookmarls in list...</div>

                <ul v-else>
                    <li v-for="item in bookmarks" :key="item.url">

                        <pre>{{ item.url }}</pre>
                        <pre>{{ item.update }}</pre>

                    </li>
                </ul>

                <div class="card card-body">
                    <pre>{{ bookmarks }}</pre>
                </div>

            </div>

        </div>
    </div>

    <script src="dist/scripts/main.js"></script>

</body>
</html>
