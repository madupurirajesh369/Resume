module.exports = (sequelize, Sequelize) => {
    const Project = sequelize.define("project", {
      title: {
        type: Sequelize.STRING
      },
      status: {
        type: Sequelize.STRING
      },
      
    });
  
    return Project;
  };
  