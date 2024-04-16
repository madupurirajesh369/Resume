const db = require("../models");
const User = db.users; // Assuming your User model is named 'User' in your Sequelize models
const chance = require('chance');


async function seedUsers() {
  try {
    // Generate fake user data
    const users = [];
    const chanceInstance = new chance();
    for (let i = 0; i < 10; i++) {
      const user = {
        name: chanceInstance.name(),
        email: chanceInstance.email()
      };
      users.push(user);
    }

    // Insert fake users into the database using Sequelize
    await User.bulkCreate(users);

    console.log('Seed data inserted successfully.');
  } catch (error) {
    console.error('Error seeding data:', error);
  }
}

// Call the function to seed the users
seedUsers();
