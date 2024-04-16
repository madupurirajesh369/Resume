
const users = require("../controllers/user.controller.js");
const projects = require("../controllers/project.controller.js");

const router = require("express").Router();

router.post("/", users.create);

router.get("/", users.findAll);

router.get("/:userId/projects", users.findUserProjects);


router.get("/:id", users.findOne);
router.put("/:id", users.update);
router.delete("/:id", users.delete);



module.exports = router;