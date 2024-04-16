module.exports = app => {
    const projects = require("../controllers/project.controller.js");
  
    var router = require("express").Router();
  
    router.post("/", projects.create);
  
    router.get("/", projects.findAll);
  
    router.get("/:id", projects.findOne);
  
    router.put("/:id", projects.update);
  
    router.delete("/:id", projects.delete);
    
    

    app.use('/api/projects', router);
  };
  