# Design Pattern and Performance Tuning

## Design Choices

### 1. Repository and Service Patterns

-   Purpose: To decouple the business logic from the data access layer (query logic).
    Repository for query logic and Service for business logic
    Implementation: Each entity (Book, Author) has a dedicated repository and service. This setup enhances testability
    and makes the codebase more maintainable.

## Performance Tuning Techniques

### 1. Database Indexing

-   Fields Indexed: Fields such as author_id in books and name, birth_date in authors are indexed.
    Impact: Indexing these fields significantly reduces the query time for search, filter,
    and join operations, which are frequent in the application.

### 2. Redis Caching

-   Configuration: Utilized Redis for caching frequently accessed data
    such as book lists and author details.
    Impact: This reduces repeated database queries, lowering response times
    and decreasing database load during peak usage.

### 3. Query Optimization

-   Purpose: use `with()` to reduce the load time and database queries by efficiently loading relationships
    and use pagination to manage large datasets efficiently.
    Impact: Pagination limits the data sent over the network and loaded in memory, enhancing the UI/UX
    and reducing server load and crucial for operations involving complex data retrieval like listing books with author details.
