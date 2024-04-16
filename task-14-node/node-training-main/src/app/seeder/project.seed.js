const chance = require('chance');
const db = require("../models");
const Project = db.projects; 
const User = db.users; 

async function seedProjects() {
  try {
    // Fetch all users from the database
    const users = await User.findAll({ attributes: ['id'] });

    // Generate fake project data and associate each project with a random user id
    const projects = [];
    const chanceInstance = new chance();
    for (let i = 0; i < 10; i++) {
      const randomUserIndex = chanceInstance.integer({ min: 0, max: users.length - 1 });
      const project = {
        title: chanceInstance.sentence({ words: 3 }), 
        status: chanceInstance.pickone(['In Progress', 'Completed', 'Pending']), 
        userId: users[randomUserIndex].id 
      };
      projects.push(project);
    }

    // Insert fake projects into the database using Sequelize
    await Project.bulkCreate(projects);

    console.log('Seed data inserted successfully.');
  } catch (error) {
    console.error('Error seeding data:', error);
  }
}

// Call the function to seed the projects
seedProjects();
