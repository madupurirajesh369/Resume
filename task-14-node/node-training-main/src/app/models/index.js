const dbConfig = require("../config/db.config.js");
const Sequelize = require("sequelize");
const sequelize = new Sequelize(dbConfig.DB, dbConfig.USER, dbConfig.PASSWORD, {
  host: dbConfig.HOST,
  dialect: dbConfig.dialect,
  operatorsAliases: false,

  pool: {
    max: dbConfig.pool.max,
    min: dbConfig.pool.min,
    acquire: dbConfig.pool.acquire,
    idle: dbConfig.pool.idle
  }
});

const db = {};

db.Sequelize = Sequelize;
db.sequelize = sequelize;

// Import and define models
const UserModel = require("./user.model.js")(sequelize, Sequelize);
const ProjectModel = require("./project.model.js")(sequelize, Sequelize);

// Define associations
UserModel.hasMany(ProjectModel, { onDelete: 'CASCADE' }); // One user can have many projects
ProjectModel.belongsTo(UserModel); // Each project belongs to a single user

// Export models
db.users = UserModel;
db.projects = ProjectModel;

module.exports = db;
