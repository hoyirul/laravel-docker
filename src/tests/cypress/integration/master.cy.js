describe("Landing page and login to crud", () => {
    it("Visit to Login Page", () => {
      cy.visit("/");
      cy.get('[data-id="btnToLogin"]').click()
    });
  
    it("Login Page", () => {
        cy.visit("/login");
        cy.get('[data-id="title"]').should("have.text", "BookStore*");
        cy.get('[data-id="lblEmail"]').should("have.text", "Email address");
        cy.get('[data-id="lblPassword"]').should("have.text", "Password");
        cy.get('[data-id="btnLogin"]').contains("Login").and("be.enabled");
    });
  
    it("Login required", () => {
      cy.visit("/login");
      cy.get('[data-id="title"]').should("have.text", "BookStore*");
      cy.get('[data-id="lblEmail"]').should("have.text", "Email address");
      cy.get('[data-id="lblPassword').should("have.text", "Password");
      cy.get('[data-id="btnLogin"]').contains("Login").and("be.enabled");
  
      cy.get(".btn").click();
      cy.get(".invalid-feedback").contains("The email field is required.");
      cy.get(".invalid-feedback").contains("The password field is required.");
    });
  
    it("User Cannot Login to dashboard", () => {
      cy.visit("/login");
      cy.get('[data-id="title"]').should("have.text", "BookStore*");
      cy.get('[data-id="lblEmail"]').should("have.text", "Email address");
      cy.get('[data-id="lblPassword').should("have.text", "Password");
      cy.get('[data-id="btnLogin"]').contains("Login").and("be.enabled");
  
      cy.get('[data-id="inputEmail"]').type("asxd@example.com");
      cy.get('[data-id="inputPassword"]').type("password");
      cy.get('[data-id="btnLogin"]').click();
      cy.get(".invalid-feedback").contains(
          "These credentials do not match our records."
      );
    });
  
    it("User can login to application", () => {
        cy.visit("/login");
        cy.get('[data-id="title"]').should("have.text", "BookStore*");
        cy.get('[data-id="lblEmail"]').should("have.text", "Email address");
        cy.get('[data-id="lblPassword').should("have.text", "Password");
        cy.get('[data-id="btnLogin"]').contains("Login").and("be.enabled");
  
        cy.get('[data-id="inputEmail"]').type("admin@bookstore.com");
        cy.get('[data-id="inputPassword"]').type("12345678");
        cy.get('[data-id="btnLogin"]').click();
  
        cy.get('[data-id="avatar"]').click();
        cy.get('[data-id="btnLogout"]').click();
        cy.get('[data-id="btnToHome"]').click();
        
    });

    it("User can Display | Create | Edit | Delete Authors in Master Data in application", () => {
        cy.visit("/login");
        cy.get('[data-id="inputEmail"]').type("admin@bookstore.com");
        cy.get('[data-id="inputPassword"]').type("12345678");
        cy.get('[data-id="btnLogin"]').click();

        cy.get('[data-id="masterData"]').click();
        cy.get('[data-id="authors"]').click();
        cy.get('[data-id="titleAuthor"]').should("have.text", "Tabel Data Authors");
        
        cy.get('[data-id="authorAdd"]').click();
        cy.get('[data-id="inputNameAuthor"]').type("BlackBox Testing");
        cy.get('[data-id="btnAddAuthor"]').click();

        cy.get('[data-id="authorEdit2"]').click();
        cy.get('[data-id="inputEditNameAuthor"]').clear();
        cy.get('[data-id="inputEditNameAuthor"]').type("BlackBox Testing Edit");
        cy.get('[data-id="btnUpdateAuthor"]').click();

        cy.get('[data-id="authorDelete9"]').click();

        cy.get('[data-id="avatar"]').click();
        cy.get('[data-id="btnLogout"]').click();
        cy.get('[data-id="btnToHome"]').click();
    });
  });