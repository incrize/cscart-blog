### Business requirements

1. There can be an unlimited number of categories
2. Categories can be disabled
3. There can be an unlimited number of posts
4. Each post can be in several categories
5. Each post can have an unlimited number of tags
6. Authors can manage their posts
7. Administrator can manage all posts and categories
8. Guests can view published posts, provided that the post has at least one active category.
9. Disabled categories should not be displayed to authors and guests.

### API requests example

### Login

```
mutation {
  login(email: "admin@example.com", password: "admin") {
    token
    user {
      id
      email
      firstname
    }
  }
}
```

### Create category

```
mutation {
  blogCategoryCreate(
    input: { title: "Category", slug: "cat", status: ACTIVE }
  ) {
    data {
      id
    }
  }
}
```

### Update category

```
mutation {
  blogCategoryUpdate(filter: { id: { eq: 1 } }, input: { status: ACTIVE }) {
    data {
      id
    }
  }
}
```


### Create post

```
mutation {
  blogPostCreate(
    input: {
      title: "Post"
      content: "Content"
      categories: { sync: { id: { in: [1, 2, 3] } } }
      tags: { create: [{ title: "tag1" }, { title: "tag2" }] }
    }
  ) {
    data {
      id
    }
  }
}
```

### Update post

```
mutation {
  blogPostUpdate(
    filter: { id: { eq: 3 } }
    input: { published_at: "2023-05-23 13:43:32" }
  ) {
    data {
      id
    }
  }
}
```

### Get posts

```
query {
  blogPosts(filter: {category_ids: [2]}) {
    data {
      id
      title
      categories {
        id
        title
      }
      tags {
        title
      }
    }
  }
}
```
