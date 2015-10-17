Feature: BarOrPub-Create-Retrieve-Update-Delete
  In order to play with bars
  As a client software developer
  I need to be able to retrieve, create, update and delete JSON-LD encoded resources.

  @createSchema
  Scenario: Create a resource
    When I send a "POST" request to "/bar_or_pubs" with body:
    """
    {
      "id": 1,
      "name": "My new bar",
      "lat": "48.8709873",
      "lon": "2.3449321"
    }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/BarOrPub",
      "@id": "/bar_or_pubs/1",
      "@type": "http://schema.org/BarOrPub",
      "openingHours": null,
      "priceRange": null,
      "address": null,
      "aggregateRating": null,
      "geo": null,
      "photo": null,
      "review": null,
      "telephone": null,
      "description": null,
      "name": "My new bar",
      "url": null
    }
    """

  Scenario: Get a resource
    When I send a "GET" request to "/bar_or_pubs/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/BarOrPub",
      "@id": "/bar_or_pubs/1",
      "@type": "http://schema.org/BarOrPub",
      "openingHours": null,
      "priceRange": null,
      "address": null,
      "aggregateRating": null,
      "geo": null,
      "photo": null,
      "review": null,
      "telephone": null,
      "description": null,
      "name": "My new bar",
      "url": null
    }
    """

  Scenario: Update a resource
    When I send a "PUT" request to "/bar_or_pubs/1" with body:
    """
    {
      "@id": "/bar_or_pubs/1",
      "name": "A new name"
    }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/ld+json"
    And the JSON should be equal to:
    """
    {
      "@context": "/contexts/BarOrPub",
      "@id": "/bar_or_pubs/1",
      "@type": "http://schema.org/BarOrPub",
      "openingHours": null,
      "priceRange": null,
      "address": null,
      "aggregateRating": null,
      "geo": null,
      "photo": null,
      "review": null,
      "telephone": null,
      "description": null,
      "name": "A new name",
      "url": null
    }
    """

  @dropSchema
  Scenario: Delete a resource
    When I send a "DELETE" request to "/bar_or_pubs/1"
    Then the response status code should be 204
    And the response should be empty
